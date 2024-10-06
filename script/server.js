const express = require('express');
const { MongoClient, Timestamp } = require('mongodb');
const app = express();
const port = 3000;

//Connexion à MongoDB
const uri = "mongodb://localhost:27017"; //URL de connexion locale
const client = new MongoClient(uri);

async function connectToDatabase() {
    await client.connect();
    console.log("Connected to MongoDB");
    return client.db('arcadia').collection('animal_view_stats');
}
// Incrémente nombre de vues
app.get('animals/:id/view', async (req, res) => {
    const animalId = req.params.id;
    const collection = await connectToDatabase();
    // Incrémenter ou insérer un nouveau document
    await collection.updateOne(
        { animal_id: animalId },
        { $inc: { count: 1 }, $set: { timestamp: new Date() } },
        { upsert: true }
    );
    res.send({ message: `Consultation de l'animal ${animalId} enregistrée.`});
});

//Récupérer les statistiques de consultation
app.get('/animals/stats', async (req, res) => {
    const collection = await connectToDatabase();
    // Rechercher tous les statistiques d'animaux
    const stats = await collection.find({}).toArray; // Pour trouver tous les documents de la collection
    if (stats.length > 0) {
        res.send(stats);
    } else {
        res.send([]);
    }
});

//Démarrer le serveur
app.listen(port, () => {
    console.log(`Serveur en route à htpp://localhost:${port}/`);
});


