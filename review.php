<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, 
                initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>The Product Review and Rating</title>

    <style>
            body {
    font-family: Arial, sans-serif;
    background-image: url('images/background_no-logo.png');
    background-size: cover;
    background-repeat: no-repeat;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 400px;
}

h1 {
    font-size: 24px;
    margin: 0;
}

.rating {
    font-size: 20px;
    margin: 10px 0;
}

.stars {
    font-size: 30px;
    margin: 10px 0;
}

.star {
    cursor: pointer;
    margin: 0 5px;
}

.one {
    color: rgb(255, 0, 0);
}

.two {
    color: rgb(255, 106, 0);
}

.three {
    color: rgb(251, 255, 120);
}

.four {
    color: rgb(255, 255, 0);
}

.five {
    color: rgb(24, 159, 14);
}

textarea {
    width: 90%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #007BFF;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.reviews {
    margin-top: 20px;
    text-align: left;
}

.review {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    margin: 10px 0;
}

.review p {
    margin: 0;
}
        </style>
</head>

<body>
    <div class="container">
        <h1>Rate Us!</h1>
        <div class="rating">
            <span id="rating">0</span>/5
        </div>
        <div class="stars" id="stars">
            <span class="star" data-value="1">★</span>
            <span class="star" data-value="2">★</span>
            <span class="star" data-value="3">★</span>
            <span class="star" data-value="4">★</span>
            <span class="star" data-value="5">★</span>
        </div>
        <p>Share your review:</p>
        <textarea id="review" placeholder="Write your review here">
        </textarea>
        <button id="submit">Submit</button>
        <div class="reviews" id="reviews">
        </div>
    </div>
    <script src="review.js"></script>
</body>

</html>