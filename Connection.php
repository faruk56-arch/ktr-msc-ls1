<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Se Connécter</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="style/style.css">
</head>

<body>
	<div class='box'>
		<div class='box-form'>
			<div class='box-login-tab'></div>
			<div class='box-login-title'>
				<div class='i i-login'></div>
				<h2>Connexion profile</h2>
			</div>
			<div class='box-login'>
				<div class='fieldset-body' id='login_form'>
					<button onclick="openLoginInfo();" class='b b-form i i-more' title='Mais Informações'></button>
					<form action="functions.php" method="post">
					<p class='field'>
						<label for='name'>Identificant</label>
						<input type='text' id='name' name='name' title='Identificant' required/>
						<span id='valida' class='i i-warning'></span>
					</p>
					<p class='field'>
						<label for='password'>Mot de passe</label>
						<input type='password' id='password' name='password' title='Mot de passe' required />
						<span id='valida' class='i i-close'></span>
					</p>

					  <input type='submit' id='do_login' value='Se Connécter' title='Login' />
					</form>
				</div>
			</div>
		</div>
		<div class='box-info'>
			<p><button onclick="closeLoginInfo();" class='b b-info i i-left' title='Back to Sign In'></button>
				<h3>Besion d'aide?</h3>
			</p>
			<div class='line-wh'></div>
			<button onclick="" class='b-support' title='Forgot Password?'> Mot de passe oublié?</button>
			<button onclick="" class='b-support' title='Contact Support'> Support</button>
			<div class='line-wh'></div>
			<button onclick="" class='b-cta' title='Sign up now!'><a href="Inscription.php">Créer un compte</a></button>
		</div>
	</div>

<script>

$(document).ready(function() {
    $("#do_login").click(function() { 
       closeLoginInfo();
       $(this).parent().find('span').css("display","none");
       $(this).parent().find('span').removeClass("i-save");
       $(this).parent().find('span').removeClass("i-warning");
       $(this).parent().find('span').removeClass("i-close");
       
        var proceed = true;
        $("#login_form input").each(function(){
            
            if(!$.trim($(this).val())){
                $(this).parent().find('span').addClass("i-warning");
            	$(this).parent().find('span').css("display","block");  
                proceed = false;
            }
        });
       
        if(proceed) //everything looks good! proceed...
        {
            $(this).parent().find('span').addClass("i-save");
            $(this).parent().find('span').css("display","block");
        }
    });
    
    //reset previously results and hide all message on .keyup()
    $("#login_form input").keyup(function() { 
        $(this).parent().find('span').css("display","none");
    });
 
  openLoginInfo();
  setTimeout(closeLoginInfo, 1000);
});

function openLoginInfo() {
    $(document).ready(function(){ 
    	$('.b-form').css("opacity","0.01");
      $('.box-form').css("left","-37%");
      $('.box-info').css("right","-37%");
    });
}

function closeLoginInfo() {
    $(document).ready(function(){ 
    	$('.b-form').css("opacity","1");
    	$('.box-form').css("left","0px");
      $('.box-info').css("right","-5px"); 
    });
}

$(window).on('resize', function(){
      closeLoginInfo();
});

</script>


</body>

</html>