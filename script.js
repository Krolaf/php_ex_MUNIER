 // Fonction JavaScript pour modifier les stats côté client
 function modifyStat(id, increment) {
    const statInput = document.getElementById(id);
    let currentValue = parseInt(statInput.value);
    if (!isNaN(currentValue)) {
        currentValue += increment;
        statInput.value = currentValue > 0 ? currentValue : 0; // Empêche les valeurs négatives
    }
}