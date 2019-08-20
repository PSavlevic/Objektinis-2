<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>
<form id="add-post">
    <input type="text" name="condition">
    <input type="submit">
</form>
</body>
</html>
<script>
    const sendUrl = "api/drinks/get.php";

    document.getElementById("add-post").addEventListener("submit", e => {
        e.preventDefault();

        let formData = new FormData();

        const conditions = {
            name: e.target.condition.value,
        };

        const jsonCond = JSON.stringify(conditions);

        formData.append('conditions', jsonCond);

        fetch(sendUrl, {
            method: "POST",
            body: formData
        })
            .then(response => {
                response.json().then(obj =>
                    console.log(obj);
                })
            })
            .catch(e => console.log(e.message));
    });
</script>
