<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Paiement</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input,
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Formulaire de Paiement</h2>
        <form action="/paiement" method="POST">
            {{ csrf_field() }}
            <!-- Champ pour entrer le montant -->
            <label for="montant">Montant :</label>
            <input type="number" id="montant" name="montant" min="0" step="0.01" required>


            <label for="phonenumber">Numero de téléphone :</label>
            <input type="number" id="phonenumber" name="phonenumber" min="0" step="0.01" required>


            <!-- Sélection du type de paiement -->
            <label for="type_paiement">Type de paiement :</label>
            <select id="type_paiement" name="type_paiement" required>
                <option value="">Sélectionnez un type</option>
                <option value="TMONEY">Tmoney</option>
                <option value="FLOOZ">Flooz</option>

            </select>



            <!-- Bouton de soumission -->
            <button type="submit">Payer</button>
        </form>
    </div>
</body>


</html>
