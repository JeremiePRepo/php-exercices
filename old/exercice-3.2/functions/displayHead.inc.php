<?php
function displayHead(){
    $output = ' <!DOCTYPE html>
                <html lang="fr">
                <head>
                    <title>La Cabane Anti-Gaspi</title>
                    <meta charset="utf-8">
                    <meta name="author" content="Jérémie Pasquis">
                    <meta name="description" content="Toutes les astuces pour éviter le gaspillage">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    
                    <!-- Font Awsome -->
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
                    
                    <!-- Google fonts -->
                    <link href="https://fonts.googleapis.com/css?family=Oswald:300" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Merriweather:400i" rel="stylesheet">
                    
                    <!-- Latest compiled and minified Bootstrap CSS -->
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

                    <!-- Custom CSS -->
                    <link rel="stylesheet" href="vue/css/style.min.css">

                    <!-- jQuery -->
                    <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
                    
                    <!-- Latest compiled and minified Bootstrap JavaScript -->
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                    
                </head>
                <body>
                    <div class="container">
                            <header>
                                <a href="/" class="header-logo"><img src="vue/img/logos/logo.jpg" alt="Logo La Cabane Anti-gaspi"></a>';
    return $output;
}