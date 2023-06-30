<div class="footer" id="footer">
    <p>&copy; PointblancDev <?php 
        $year = 2023;
        if($year == date('Y'))
        {
            echo $year;
        }
        else 
        {
            echo $year . " - " . date('Y');
        }
    ?></p>
</div>