<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/styleProva.css">


<link rel="icon" type="image/png" href="../img/favicomatic/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="../img/favicomatic/favicon-16x16.png" sizes="16x16" />
<link rel="stylesheet" href="">
</head>
<body>
	<!-- Sostituire con tag HTML5 <header>? Vedere pro e contro
		Contro: XHTML5 non esiste -> in xhtml i tag header e footer non esistono.

	-->
	<div class="nav" id="nav">
		<div class="nav__logo-container" id="nav__logo-container">
			<a href=""> 
				<img src="../logo/logo_TVhunter.png" alt="logo del sito, riporta alla homepage">		
			</a>
		</div>
		
		<div class="nav__ricerca">
			<input type="text" placeholder="Search..">
		</div>
		
		<ul class="nav__top-list list_no-style	" id="nav__top-list">
			<li class="nav__esplora"><a href="" title="Esplora">Esplora</a></li>
			<li class="nav__restricted nav__profilo"><a href="" title="Profilo">Profilo</a></li>
			<li class="nav__restricted nav__preferiti"><a href="" title="Preferiti">Preferiti</a></li>
		</ul>

		<ul class="nav__bottom-list list_no-style">
			<li class="nav__restricted nav__impostazioni"><a href="" title="Impostazioni">Impostazioni</a></li>
			<li class="nav__faq"><a href=""><acronym title="Frequently Asked Questions">FAQ</acronym></a></li>
			<li class="nav__supporto"><a href="" title="Supporto">Supporto </a></li>
			<li class="nav__privacy"><a href="" title="Privacy"><span xml:lang="EN">Privacy</span></a></li>
			<li class="nav__about"><a href="" title="About"><span xml:lang="EN">About</span></a></li>
   		</ul>

		<div class="nav__social">
		</div>
		<div class="nav__icon">
			<a href="javascript:void(0);" onclick="myFunction()"><i class=""></i>Pulsante</a> <!-- TODO: aggiungere pulsante icons -->
		</div>

	</div>

	<div class="page-center"><!-- TODO: aggiungere spaziatura tra div e far vedere la navbar -->
		<div class="header">
			<div class="header-content">
				<h1>TV Hunter</h1>
			</div>
		</div>
		<div id="signup" class="content">	
    		 <div id="signup__top" class="signup">
                <form action="signup_action.php">
                    <div class="signup__riga">
                      <h2>Registrati</h2>
                      <div class="signup__colonna">
                        <!-- div class="hide-md-lg">
                          <p>Or sign in manually:</p>
                        </div>
                     -->
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="text" name="nome" placeholder="Nome" required>
                        <input type="text" name="cognome" placeholder="Cognome" required>
                        <input type="date" name="datanascita" placeholder="Data di nascita (es. 10/02/1997)" required>                        
                        <input type="submit" value="signup">
                      </div>
                    
                    </div>
                </form>
    		</div>
    
            <div class="bottom-container">
              <div class="signup__riga">
                <div class="signup__colonna">
                  <a href="login.php" style="color:white" class="btn"><span xml:lang="EN">Login</span></a>
                </div>
                <div class="signup__colonna">
                  <a href="#" style="color:white" class="btn">Forgot password?</a>
                </div>
              </div>
            </div> 
         </div>
	</div>

	<div class="footer">
		<div class="footer__nav">
			<ul class="list_no-style">
				<li><a href="">Supporto </a></li>
				<li><a href=""><span xml:lang="EN">Privacy</span></a></li>
				<li><a href="">About</a></li>
			</ul>	
		</div>
	</div>

<script>
var modal = document.getElementById('myModal');

function myFunction() {
    var x = document.getElementById("nav");
    var y = document.getElementById("nav__top-list");
    var z = document.getElementById("nav__logo-container");


    if (x.className === "nav") {
        x.className += " responsive";
        y.className += " responsive";
        z.className += " responsive";
    } else {
        x.className = "nav";
        y.className = "nav__top-list";
        z.className = "nav__logo-container";
    }
}

</script>

</body>
</html>


