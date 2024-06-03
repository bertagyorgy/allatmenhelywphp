// Első lépésként megvárjuk, amíg az összes elem betöltődik a DOM-ba
document.addEventListener("DOMContentLoaded", function () {
    // Az elemek kiválasztása az id alapján
    var searchForm = document.getElementById("search-form");
    var searchInput = document.getElementById("search-input");
    var clearSearchBtn = document.getElementById("clear-search");

    // Eredeti állapot mentése a keresési eredményekhez
    var originalResults = document.querySelectorAll(".dog");

    // Kereső funkció kezelése
    searchForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Az alapértelmezett formanyitás megakadályozása
        var searchTerm = searchInput.value.toLowerCase(); // A keresőmező értékének kisbetűssé alakítása és eltárolása

        // Szűrés a keresett név alapján
        var filteredResults = [];
        originalResults.forEach(function (result) {
            var dogName = result.textContent.toLowerCase(); // A keresett kutyanevet szintén kisbetűssé alakítjuk
            if (dogName.includes(searchTerm)) {
                filteredResults.push(result); // Ha a keresett név megtalálható a kutyanevek között, hozzáadjuk az eredményekhez
            }
        });

        // Megjelenítjük a szűrt eredményeket
        displayResults(filteredResults);
    });

    // Keresés törlése gomb kezelése
    clearSearchBtn.addEventListener("click", function () {
        searchInput.value = ""; // A keresőmező tartalmának törlése
        displayResults(originalResults); // Az eredeti eredmények újramegjelenítése
    });

    // Eredmények megjelenítése
    function displayResults(results) {
        var contentDiv = document.getElementById("content");
        var searchResultsDiv = document.createElement("div");
        searchResultsDiv.id = "search-results";
        results.forEach(function (result) {
            searchResultsDiv.appendChild(result.cloneNode(true));
        });
        // Többi megjelenítése
        contentDiv.innerHTML = ""; // Tartalom törlése
        contentDiv.appendChild(searchResultsDiv); // Szűrt eredmények megjelenítése
    }
});
