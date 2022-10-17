<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>create</title>
</head>

<body>
    <div class="container col-8 p-4">
        <!-- <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div> -->
        <div id="result">
            
            <p>Lorem ipsum dolor sit amet.</p>
        </div>
        <!-- <div class="form-group">
                <label for="rate">Rate</label>
                <input type="text" class="form-control" id="rate" name="rate" placeholder="rate">
            </div>
            <div class="form-group">
                <label for="star-rate">Star rate</label>
                <input type="text" class="form-control" id="star-rate" name="rate_star" placeholder="star-rate">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="price">
            </div>
            <div class="form-group">
                <label for="discount">Price</label>
                <input type="text" class="form-control" id="discount" name="discount" placeholder="discount">
            </div>
            <div class="form-group">
                <label for="Created_at">Created_at</label>
                <input type="text" class="form-control" id="created_at" name="Created_at" placeholder="Created_at">
            </div>
            <div class="form-group">
                <label for="Updated_at">Created_at</label>
                <input type="text" class="form-control" id="updated_at" name="Updated_at" placeholder="Updated_at">
            </div>
            <div class="form-group mt-3">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control-file" autofocus>
            </div> -->
        <!-- <div class="form-check"> -->
        <!-- </div> -->
        <button type="submit" class="btn btn-primary">Submit</button>
        <!-- </form> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("button").click(function() {
            $.get('/jquery', function(data) {
                $('#result').html(data);
            })
        })
    })
</script>

</html>