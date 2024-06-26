<?php require 'lib/utils.php'; 
include 'partials/top.php';
// Connect to the database 
$db = connectToDB(); 

// Setup a query to get all company info 
$query = 'SELECT * FROM services ORDER BY name ASC';

try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $services = $stmt->fetchAll();
}

catch (PDOException $e) {
    consoleLog($e->getMessage(), ERROR);
    die();
}

$query = 'SELECT id, `name` FROM staff ORDER BY `name` ASC';

try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $staff = $stmt->fetchAll();
}

catch (PDOException $e) {
    consoleLog($e->getMessage(), ERROR);
    die();
}
consoleLog($staff);

$query = 'SELECT * FROM Reviews';

try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $reviews = $stmt->fetchAll();
}

catch (PDOException $e) {
    consoleLog($e->getMessage(), ERROR);
    die();
}

?>
<main>  
    <section id="hero_image">
        <img src="" alt="">
        <h1>Geosolutions</h1>
    </section>
    
    <section id="about">
        <h2>About Us</h2>
        <p>Lorem ipsum dolor sit amet consectetur. Leo quam bibendum sem mattis egestas ultrices id fermentum. Pellentesque faucibus urna scelerisque ultricies faucibus tristique vitae nullam. Augue nisi nunc lobortis nisl tellus. Non egestas dolor vestibulum egestas aliquam facilisi vitae.</p>
    </section>

    <section id="contact">
        <h2>Contact us</h2>
        <p>1282 address bla bla, Email email, phone</p>
        <a href="booking_form.php">Book A Consultation</a>
    </section>

    <section id="Services">
        <h2>Services</h2>
<?php
        foreach($services as $service) {
    echo    '<ul>';         
    echo    '<li><a href="service_info.php?id=' . $service['id'] . '">' . $service['name'] . '</a></li>';
    echo    '</ul>';       
}
?>
    </section>

    <section id="staff">
<?php
        foreach($staff as $staffMember) {
    echo    '<div id="staffmember">';   
    echo    '<img src="load-staff-image.php?id=' . $staffMember['id'] . '">';      
    echo    '<h1>' . $staffMember['name'] . '</h1>';
    echo    '</div>';       
}
?>
    </section>

    <section id="reviews">
        <h1>Reviews</h1>
        <div class="scrolling-wrapper">
<?php
        foreach($reviews as $review) {
    echo    '<div class="card"><h2>' . $review['title'] . '</h2>';     
    foreach(range(1,$review['stars']) as $stars){
        echo    '✯';   
    }
    echo    '<p>' . $review['content'] . '</p>';
    echo    '</div>'; 

}
?>
        </div>
    </section>
</main>


<?php include 'partials/bottom.php'; ?>