function enregistrerHoraires() {
    //Récupérer les données du fomulaire
    let jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    let horaires = {};

    jours.forEach(jour => {
        let ouverture = document.getElementById(`ouverture_${jour}`).value;
        let fermeture = document.getElementById(`fermeture_${jour}`).value;
        horaires[jour] = { ouverture, fermeture };
    });

    //Afficher un message de confirmation
    document.getElementById("message").innerHTML = "Horaires mis à jour avec succès !";
    console.log("Horaires récupérés : ", horaires); //Afficher les horaires dans la console pour vérification

    // Afficher les horaires dans le footer
    let footerHtml = "<ul>";
    for (let jour in horaires) {
        footerHtml += `<li>${jour}: ${horaires[jour].ouverture} - ${horaires[jour].fermeture}</li>`;
    }
    footerHtml += "</ul>";
    document.getElementById("horairesFooter").innerHTML = footerHtml;
};