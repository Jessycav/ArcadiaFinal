const { MongoClient} = require('mongodb');

// Connexion à la base de données MongoDB
async function logAnimalView(animalId) {
    const uri = "mongodb://localhost:27017"; //URL de connexion locale
    const client = new MongoClient(uri);

    try {
        await client.connect();
        const database = client.db("arcadia");
        const collection = database.collection("animal_view_stats");

        //Insertion d'une nouvelle consultation
        const result = await collection.insertOne({
            animal_id: animalId,
            count: 1
        });

        console.log(`Consultation enregistrée avec l'ID : ${result.insertedId}`);
    } finally {
        await client.close();
    }
}

// Exemple d'utilisation
logAnimalView("1").catch(console.error);