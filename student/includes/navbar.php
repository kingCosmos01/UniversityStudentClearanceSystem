<div class="nabvar">
    <div class="wrapper">
        <div class="left">
            <h4>Student Dashboard</h4>
        </div>
        <div class="right">
            <p class="dropDown" id="dropDown">
                Howdy, <b><?php if(isset($_SESSION['student'])) {
                    $name = $_SESSION['student'];

                    echo $name[0];
                 
                } ?></b>

                <span></span>
                <span></span>
            </p>
        </div>
    </div>
</div>