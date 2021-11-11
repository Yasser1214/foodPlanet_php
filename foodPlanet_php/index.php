<?php
 

 ############ Connect DataBase, create tables if not exists and generate and read datas ############

require_once 'php/session.php';
require_once 'php/database.php';
require_once 'php/create.php';


?>


<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="pictures/favicon.ico">
        <title> foodPlanet - Home </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jQuery/jquery-3.6.0.slim.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>

    <body>
        
        <header>
            <h1 class="brand"> Welcome to <span class="food">food</span><span class="planet">Planet</span> <img id="logo" src="pictures/foodplanet.png"> </h1> 
        </header>
        <div class="bar"></div>

        <input type="hidden" name="authentification" id="authentification" value='<?php echo $_SESSION['authentification']; ?>'>

        <?php if(is_logged()): ?>

            <div id="user"> 

                <form method="POST" action="index.php">
                    <input type="submit" name="connected" id="connected" value='<?php echo $_SESSION['user']; ?>'>
                    <p style="font-size: 11px; margin-left: 15px; color: #900000;">click on to disconnect</p>
                </form>

            </div> 

        <?php else: ?> 

            <div id="auth-block">

                <input type="submit" name="registration" id="registration" class="auth-button" value="Register">

                <input type="submit" name="connection" id="connection" class="auth-button" value="Connect">

            </div> 

        <?php endif; ?>   
            
        <div id="registration-form" style="display: none;">

            <form method="POST" action="index.php">

                <h2> Registration form </h2>

                <label>username : </label>
                <input type="text" name="username-register" id="username-register" required>

                <label>address : </label>
                <input type="text" name="address-register" id="address-register" required>

                <label>zip code : </label>
                <input type="number" name="zipcode-register" id="zipcode-register" min="10000" max="99999" required>

                <label>email : </label>
                <input type="email" name="email-register" id="email-register" required>

                <label>password : </label>
                <input type="password" name="password-register" id="password-register" maxlength="32" required>

                <input type="submit" name="submit-registration" id="submit-registration" class="submit-auth" value="Validate">

            </form>

        </div>

        <div id="connection-form" style="display: none;"> 

            <form method="POST" action="index.php">

                <h2> Connection form </h2>

                <label>email : </label>
                <input type="email" name="email-connect" id="email-connect" required>

                <label>password : </label>
                <input type="password" name="password-connect" id="password-connect" required>

                <label id="rating-label">How do you find our service last time ?</label>
                <div id="radio" style="display: flex; flex-direction: column;"> 
                    <label style="display: flex; flex-direction: row;">Excellent
                    <input type="radio" name="rating" id="rating" value="5/5" checked></label>    
                    
                    <label style="display: flex; flex-direction: row;">Good
                    <input type="radio" name="rating" id="rating" value="4/5"></label>
                    
                    <label style="display: flex; flex-direction: row;">Pretty good 
                    <input type="radio" name="rating" id="rating" value="3/5"></label> 
                    
                    <label style="display: flex; flex-direction: row;">Average
                    <input type="radio" name="rating" id="rating" value="2/5"></label>   
                    
                    <label style="display: flex; flex-direction: row;">Not good
                    <input type="radio" name="rating" id="rating" value="1/5"></label>
                    
                    <label style="display: flex; flex-direction: row;">A shame
                    <input type="radio" name="rating" id="rating" value="0/5"></label>
                </div>

                <input type="submit" name="submit-connection" id="submit-connection" class="submit-auth" value="Validate">

            </form>

        </div>

        <form method="POST" action="php/confirm.php" id="items-form">

            <div id="submit-block">

                <div id="promo">
                    <h2> Promo code : </h2>
                    <input type="text" name="promotion" id="promo-value" placeholder="- <?php echo strval($promo_value*100) ?> % with promo code !">
                    <p id="promo-message"></p>
                    <button id="apply-promo">Apply</button>
                    <input type="hidden" name="apply-promotion" id="apply-promo-val">
                </div>

                 <div id="submit">
                    <input type="submit" name="submit-selection" id="select-menu" value="Validate order">
                    <p id="isAuthentified"></p>
                </div>

            </div>

            <div id="items-buttons" style="display: none;">
                <ul>
                    <li> <button id="display-menus"><img src="pictures/menus.png"> <p>Menus</p></button> </li>
                    <li> <button id="display-sand"><img src="pictures/sandwichs.png"> <p>Sandwichs</p></button> </li>
                    <li> <button id="display-accomp"><img src="pictures/accompaniments.png"> <p>Accompaniments</p></button> </li>
                    <li> <button id="display-drinks"><img src="pictures/drinks.png"> <p>Drinks</p></button> </li>
                </ul>
            </div>

            <div id="welcome-panel" class="item-panel">
                <ul>
                    <li> <button id="display-menus2"><img src="pictures/menus.png"> <p>Menus</p></button> </li>
                    <li> <button id="display-sand2"><img src="pictures/sandwichs.png"> <p>Sandwichs</p></button> </li>
                    <li> <button id="display-accomp2"><img src="pictures/accompaniments.png"> <p>Accompaniments</p></button> </li>
                    <li> <button id="display-drinks2"><img src="pictures/drinks.png"> <p>Drinks</p></button> </li>
                </ul>
            </div>

            <div id="menu" class="item-panel" style="display: none;">

                <h2 class="item-title"> Menus </h2>

                <ul>
                    <li>
                        <div class="item">
                            <label for="ham-menu"><img src="pictures/ham-menu.png"></label>
                            <p> Hamburger - menu : <span class="item-price">5.5 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="menu[]" value="ham-menu" class="checkboxes" id="checkboxm1">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#nb_ham-menu').stepDown(); $('#checkboxm1').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_m[0] ?>' name="nb-menu[]" class="nb" min="1" max="50" id="nb_ham-menu" class="number-item">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#nb_ham-menu').stepUp(); $('#checkboxm1').attr('checked', true)">+</button> 
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="item">
                            <label for="cheese-menu"><img src="pictures/cheese-menu.png"></label>
                            <p> Cheeseburger - menu : <span class="item-price">6.5 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="menu[]" value="cheese-menu" class="checkboxes" id="checkboxm2">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#nb_cheese-menu').stepDown(); $('#checkboxm2').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_m[1] ?>' name="nb-menu[]" class="nb" min="1" max="50" id="nb_cheese-menu" class="number-item">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#nb_cheese-menu').stepUp(); $('#checkboxm2').attr('checked', true)">+</button>
                            </div>  
                        </div>
                    </li>

                    <li>
                        <div class="item">
                            <label for="tower-menu"><img src="pictures/tower-menu.png"></label>
                            <p> Towerburger - menu : <span class="item-price">7.5 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="menu[]" value="tower-menu" class="checkboxes" id="checkboxm3"> 
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#nb_tower-menu').stepDown(); $('#checkboxm3').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_m[2] ?>' name="nb-menu[]" class="nb" min="1" max="50" id="nb_tower-menu" class="number-item">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#nb_tower-menu').stepUp(); $('#checkboxm3').attr('checked', true)">+</button> 
                            </div>
                        </div>
                    </li>
                </ul>

            </div>

            <div id="sandwich" class="item-panel" style="display: none;">

                <h2 class="item-title"> Sandwichs </h2>

                <ul>
                    <li>
                        <div class="item">
                            <label for="hamburger"><img src="pictures/ham.png"></label>
                            <p> Hamburger : <span class="item-price">2.5 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="sand[]" value="hamburger" class="checkboxes" id="checkboxs1">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#hamburger').stepDown(); $('#checkboxs1').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_s[0] ?>' name="nb-sand[]" class="nb" min="1" max="50" id="hamburger" class="number-item">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#hamburger').stepUp(); $('#checkboxs1').attr('checked', true)">+</button> 
                            </div>
                        </div>
                    </li> 

                    <li>
                        <div class="item">
                            <label for="cheeseburger"><img src="pictures/cheese.png"></label>
                            <p> Cheeseburger : <span class="item-price">3.5 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="sand[]" value="cheeseburger" class="checkboxes" id="checkboxs2">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#cheeseburger').stepDown(); $('#checkboxs2').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_s[1] ?>' name="nb-sand[]" class="nb" min="1" max="50" id="cheeseburger" class="number-item">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#cheeseburger').stepUp(); $('#checkboxs2').attr('checked', true)">+</button> 
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="item">
                            <label for="towerburger"><img src="pictures/tower.png"></label>
                            <p> Towerburger : <span class="item-price">4.5 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="sand[]" value="towerburger" class="checkboxes" id="checkboxs3">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#towerburger').stepDown(); $('#checkboxs3').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_s[2] ?>' name="nb-sand[]" class="nb" min="1" max="50" id="towerburger" class="number-item"> 
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#towerburger').stepUp(); $('#checkboxs3').attr('checked', true)">+</button>
                            </div>
                        </div>
                    </li>  
                </ul>

            </div>

            <div id="accompaniment" class="item-panel" style="display: none;">

                <h2 class="item-title"> Accompaniments </h2>

                <ul>
                    <li>
                        <div class="item">
                            <label for="fries"><img src="pictures/fries.png"></label>
                            <p> A portion of fries : <span class="item-price">1.5 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="accomp[]" value="fries" class="checkboxes" id="checkboxa1">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#fries').stepDown(); $('#checkboxa1').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_a[0] ?>' name="nb-accomp[]" class="nb" min="1" max="50" id="fries" class="number-item"> 
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#fries').stepUp(); $('#checkboxa1').attr('checked', true)">+</button>  
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="item">
                            <label for="potatoes"><img src="pictures/potatoes.png"></label>
                            <p style="font-size: 15px;"> A portion of potatoes : <span class="item-price">1.5 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="accomp[]" value="potatoes" class="checkboxes" id="checkboxa2">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#potatoes').stepDown(); $('#checkboxa2').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_a[1] ?>' name="nb-accomp[]" class="nb" min="1" max="50" id="potatoes" class="number-item">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#potatoes').stepUp(); $('#checkboxa2').attr('checked', true)">+</button>  
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="item">
                            <label for="corn"><img src="pictures/corn.png"></label>
                            <p> An ear of corn : <span class="item-price">1.5 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="accomp[]" value="corn" class="checkboxes" id="checkboxa3"> 
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#corn').stepDown(); $('#checkboxa3').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_a[2] ?>' name="nb-accomp[]" class="nb" min="1" max="50" id="corn" class="number-item"> 
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#corn').stepUp(); $('#checkboxa3').attr('checked', true)">+</button>  
                            </div>
                        </div>
                    </li>
                </ul>

            </div>

            <div id="drink" class="item-panel" style="display: none;">

                <h2 class="item-title"> Drinks </h2>

                <ul>
                    <li>
                        <div class="item">
                            <label for="water"><img src="pictures/water.jpg"></label>
                            <p> Water (50cl) : <span class="item-price">1 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="drink[]" value="water" class="checkboxes" id="checkboxd1">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#water').stepDown(); $('#checkboxd1').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_d[0] ?>' name="nb-drink[]" class="nb" min="1" max="50" id="water" class="number-item">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#water').stepUp(); $('#checkboxd1').attr('checked', true)">+</button>
                            </div>
                        </div>
                    </li>  

                    <li>  
                        <div class="item">
                            <label for="coca"><img src="pictures/coca.png"></label>
                            <p> Coca Cola (33cl) : <span class="item-price">1.2 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="drink[]" value="coca" class="checkboxes" id="checkboxd2">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#coca').stepDown(); $('#checkboxd2').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_d[1] ?>' name="nb-drink[]" class="nb" min="1" max="50" id="coca" class="number-item">
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#coca').stepUp(); $('#checkboxd2').attr('checked', true)">+</button>
                            </div>
                        </div>
                    </li> 

                    <li> 
                        <div class="item">
                            <label for="lipton"><img src="pictures/lipton.jpg"></label>
                            <p style="font-size: 15px;"> Lipton Ice Tea (33cl) : <span class="item-price">1.2 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="drink[]" value="lipton" class="checkboxes" id="checkboxd3"> 
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#lipton').stepDown(); $('#checkboxd3').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_d[2] ?>' name="nb-drink[]" class="nb" min="1" max="50" id="lipton" class="number-item"> 
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#lipton').stepUp(); $('#checkboxd3').attr('checked', true)">+</button> 
                            </div>
                        </div>
                    </li>

                    <li> 
                        <div class="item">
                            <label for="schweppes"><img src="pictures/schweppes.jpeg"></label>
                            <p> Schweppes (33cl) : <span class="item-price">1.2 €</span></p>
                            <div class="bar"></div>
                            <div class="checktools">
                                <input type="checkbox" name="drink[]" value="schweppes" class="checkboxes" id="checkboxd4"> 
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#schweppes').stepDown(); $('#checkboxd4').attr('checked', true)">-</button>
                                <input type="number" value='<?php echo $num_d[3] ?>' name="nb-drink[]" class="nb" min="1" max="50" id="schweppes" class="number-item">  
                                <button type="button" formaction="index.php" class="addbar" onclick="this.parentNode.querySelector('#schweppes').stepUp(); $('#checkboxd4').attr('checked', true)">+</button>    
                            </div>
                        </div>
                    </li> 
                </ul>

            </div>

        </form>

        <footer>
            <div class="bar"></div>
            <p> © 2021 foodPlanet Inc. All rights reserved. </p>
        </footer>

    </body>
    
</html>