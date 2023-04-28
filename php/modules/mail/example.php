<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <script>
        const UpdatePriceCartFloating = async () => {
            let emailDestinatario = 'maxidepetris.hls@gmail.com';
            let formData = new FormData();
            formData.append('emailDestinatario', emailDestinatario);

            try {
                const res = await fetch('mailer.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.text();
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        }
        UpdatePriceCartFloating();
    </script>

</body>

</html>