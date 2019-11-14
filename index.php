<style>
@import "compass/css3";
.weatherWidgetImage{
  max-width: 100%;
}
.box{
  margin: 1px;
  background: #f0f0f0;
  padding: 1px;
  width: 250px;
  border-radius: 5px;
  box-shadow: 0px 1px 7px rgba(0,0,0, 0.25);
  &:hover{
    box-shadow: 0px 1px 4px rgba(0,0,0, 0.5);
  }
  h1{
    font-size: 2em;
    text-align: center;
  }
  .temp{
    font-size: 7em;
    line-height: 1;
    text-align: center;
    display: block;
    padding-left: 30px;
    margin-bottom: 24px;
  }
  .high-low{
    font-size: 2em;
    color: lighten(#313E48, 20%);
    text-align: center;
    display: block;
    font-weight: 100;
  }
}
.weather .icon{
  position: relative;
  margin: 0 auto;
}
.spin{
  position: absolute;
  top: 16px;
  right: 18px;
  text-align: center;
  width: 65px;
}
  .bubble.black {
    background-color: #313E48;
    position: relative;
    width: 100px;
    height: 100px;
    padding: 0px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}
  .bubble.black:after {
    content: "";
    position: absolute;
    bottom: -14px;
    left: 14px;
    border-style: solid;
    border-width: 29px 15px 0;
    border-color: #313E48 transparent;
    display: block;
    width: 0;
    z-index: 1;
    transform: rotate(30deg);
  }
//Animation
.spin img{
  animation: spin 5s linear infinite;
  animation-play-state: paused;
}
.box:hover .spin img{
   animation-play-state: running;
}
@keyframes spin {
  100% {
    transform: rotate(1turn);
  }
}
.weather-box{
    margin : 40px;
}
.weather-box-hourly{
    margin : 40px;
    background-color: lightgray;
    padding: 15px;
    border-radius: 5px;
    float : right;
}
.weather-box-hourly th{
    padding : 10px;
} 
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php 
?>

<?php if($currently){ ?>
<article class="box weather">
  <div class="icon bubble black" style="display:none;">
    <div class="spin">
      <img style="display:none;" class="weatherWidgetImage" src="#">
    </div>
  </div>
  <!-- <button onclick="getLocation()">Try It</button> -->
  <div class="weather-box">
        <p>
        <?php echo $weather->timezone; 
            $nameOfDay = date('D', $weather->currently->time);
        ?></p>
    <h1><?php echo $nameOfDay; ?></h1>
    <span><?= $weather->currently->summary ?></span>
    <h2 class="temp"><?= $weather->currently->temperature ?> &deg;<?= ($unit == 'si')?'C':'F' ?></h2></br>
    <span class="high-low"><?= $weather->currently->temperature ?>&deg;/ <?= $weather->currently->apparentTemperature ?>&deg;</span>
    <p><b>Humidity : </b><?= $weather->currently->humidity ?></p>
    <p><b>Pressure : </b><?= $weather->currently->pressure ?></p>
    <p><b>Wind Speed : </b><?= $weather->currently->windSpeed ?></p>
  </div>
</article>
<?php } ?>

<?php if($hourly){ ?>
  
  
    <div class="weather-box-hourly">
    
    <?php echo $weather->timezone; 
        $nameOfDay = date('D', $weather->currently->time);
    ?>
    <h1><?php echo $nameOfDay; ?></h1>
        <table style="padding:5px;">
            <?php foreach($weather->hourly->data as $hourly){ ?>
                <tr>
                    <th>
                    <?= date('m/d', $hourly->time); ?>
                    <?= date('h:i a', $hourly->time); ?>
                    </th>
                    <th><?= $hourly->temperature ?> &deg;<?= ($unit == 'si')?'C':'F' ?></th>
                    <th><?= $hourly->summary ?></th>
                </tr>
            <?php } ?>
        </table>
    </div>
  
<?php } ?>

<?php if($daily){ ?>
  
  
  <div class="weather-box-hourly">
  
  <?php echo $weather->timezone; 
      $nameOfDay = date('D', $weather->currently->time);
  ?>
  <h1><?php echo $nameOfDay; ?></h1>
  <h2 class="temp"><?= $weather->currently->temperature ?> &deg;<?= ($unit == 'si')?'C':'F' ?></h2></br>
      <table style="padding:5px;">
          <?php foreach($weather->daily->data as $daily){ ?>
              <tr>
                  <th>
                    <?= date('D', $daily->time) ?>
                  </th>
                  <th>
                  <?= date('m/d', $daily->time); ?>
                  <?= date('h:i a', $daily->time); ?>
                  </th>
                  <th><?= $daily->temperatureHigh ?> &deg;<?= ($unit == 'si')?'C':'F' ?></th>
                  <th><?= $daily->summary ?></th>
              </tr>
          <?php } ?>
      </table>
  </div>

<?php } ?>
