const { MongoClient } = require('mongodb');

//Fonction pour obtenir les statistiques
async function getAnimalViewStats(animalId) {
    const uri = "mongodb://localhost:27017"; //URL de connexion locale
    const client = new MongoClient(uri);
    
    try {
        await client.connect();
        const database = client.db("arcadia");
        const collection = database.collection("animal_view_stats");

        //Requête pour obtenir le nombre de consultations
        const totalViews = await collection.aggregate([
            { "$match": { "animal_id": animalId } },
            { "$group": { "_id": "$animal_id", "total_views": { "$sum": "$count" } } }
        ]).toArray();

        console.log(`Total de consultations pour l'animal $ {animalId} : `, totalViews);
    } finally {
        await client.close();
    }
}

// Exemple d'utilisation
getAnimalViewStats("Bumba").catch(console.error);