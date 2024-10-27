<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Welcome to E-Shoper Dashboard
    <button id="LogoutButton">Logout</button>
    <form action="<?=url('logout')?>" method="post" id="LogoutForm"></form>

    <script>
        const btn =document.querySelector("#LogoutButton")
        btn.addEventListener("click",()=>{
            const form =document.querySelector("#LogoutForm")
            form.submit();
        })
    </script>
</body>
</html>