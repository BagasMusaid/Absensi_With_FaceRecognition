async function trainModel() {
    const data = await fetch("/daftar-wajah/json").then((res) => res.json());
    const embeddings = data.map((item) => item.embedding);
    const labels = data.map((item) => item.label);

    const uniqueLabels = [...new Set(labels)];
    const encodedLabels = labels.map((label) => uniqueLabels.indexOf(label));

    const model = tf.sequential();
    model.add(
        tf.layers.dense({ units: 64, activation: "relu", inputShape: [128] })
    );
    model.add(tf.layers.dropout({ rate: 0.3 }));
    model.add(
        tf.layers.dense({ units: uniqueLabels.length, activation: "softmax" })
    );

    model.compile({
        optimizer: "adam",
        loss: "sparseCategoricalCrossentropy",
        metrics: ["accuracy"],
    });

    const xs = tf.tensor2d(embeddings);
    const ys = tf.tensor1d(encodedLabels, "int32");

    await model.fit(xs, ys, { epochs: 50, batchSize: 8 });

    await model.save("downloads://model-trained"); // Simpan lokal dulu
}
