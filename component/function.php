<link rel="stylesheet" href="/src/style.css">
<link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<?php

    function totalCar($pdo){

        $sql = "SELECT * FROM car";
        $stmt = $pdo->query($sql);
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    function totalUser($pdo){

        $sql = "SELECT * FROM user";
        $stmt = $pdo->query($sql);
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    function totalBooking($pdo){

        $sql = "SELECT * FROM booking";
        $stmt = $pdo->query($sql);
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

     function rental($pdo){

        $sql = "SELECT * FROM rental_packages";
        $stmt = $pdo->query($sql);
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

?>