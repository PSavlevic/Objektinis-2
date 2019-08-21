<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fetch</title>
    <link rel="stylesheet" href="media/css/normalize.css">
    <link rel="stylesheet" href="media/css/style.css">
</head>
<body>
<form id="drinks-form">
    <input type="text" name="condition">
    <input type="submit">
</form>
<div id="drinks-container">
</div>
<script>
    const endpointUrl = "api/drinks/get.php";
    const div = document.getElementById("drinks-container");


    document.getElementById("drinks-form")
        .addEventListener("submit", e => {
            e.preventDefault();

            // Kad PHP traktuotų requestą kaip POSG
            // ir normaliai sudėtų į _POST duomenis
            // reikia kurti FormData bl.
            let formData = new FormData();
            const conditions = {
                // laukelio e.target.condition.value vertė
                name: e.target.condition.value,
            };

            // Kadangi mes negalim appendinti į formData
            // array'jaus arba objekto, mums ir vėl pisliava
            // Reikia už-JSON encodinti conditionų objektą
            const jsonCond = JSON.stringify(conditions);

            // Dabar jau jsonCond yra stringas, todėl galima
            // appendinti į formData
            formData.append('conditions', jsonCond);

            // Kreipiamės į savo API'jų
            fetch(endpointUrl, {
                method: "POST",
                // Tai yra POST'o duomenys. Atsiminkime brangieji
                body: formData
            })
            // Serverio atsakymas (jau JSONinis)
                .then(response => {
                    // Kadangi responsas pas mus get.php
                    // yra json encodintas, ti mes naudojam
                    // nebe .text() o .json().`
                    div.innerHTML = "";

                    response.json()
                        .then(obj => obj.data.forEach(value => displayPosts(value)));
                        // ŠITAS OBJ yra javascriptinis objektas
                        // (išdecodintas jsonas)
                })
                .catch(e => console.log(e.message));
        });


    function displayPosts(v) {
     console.log(v);

        const h1 = document.createElement("h1");
        h1.append(document.createTextNode(v.name));
        const h2 = document.createElement("h2");
        h2.append(document.createTextNode(v.amount_ml + "ml"));
        const h3 = document.createElement("h3");
        h3.append(document.createTextNode(v.abarot + "%"));
        const img = document.createElement("img");
        img.src = v.image;
        div.append(h1, h2, h3, img);
    }
</script>
</body>
</html>