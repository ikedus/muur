<nav class="top-bar" data-topbar role="navigation">
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">de muur</a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
	</ul>
	<section class="top-bar-section">
		<ul class="right">
			<!-- START BLOCK : login -->
			<li class="has-form signinform">
				<form action="" method="post">
					<div class="row collapse">
						<div class="medium-6 columns">
							<input type="text" placeholder="e-mail" name="username">
						</div>
						<div class="medium-4 columns">
							<input type="password" placeholder="wachtwoord" name="password">
						</div>
						<div class="small-12 medium-2 columns">
							<input type="submit" value="Login" name="submit" class="button small-12 columns">
						</div>
					</div>
				</form>
			</li>
			<li class="divider show-for-small-only"></li>
			<!-- END BLOCK : login -->
			<!-- START BLOCK : topMenu -->
			<li class="has-dropdown show-for-small-only">
				<a href="#" class="heading">heey</a>
				<ul class="dropdown">
					<!-- START BLOCK : topMenuLabel -->
					<li><label>lorem</label></li>
					<!-- START BLOCK : topMenuItem -->
					<li><a href="#">ipsum</a></li>
					<!-- END BLOCK : topMenuItem -->
					<!-- END BLOCK : topMenuLabel -->
				</ul>
			</li>
			<li class="divider"></li>
			<li class="">
				<a href="stopses.php">uitloggen</a>
			</li>
			<!-- END BLOCK : topMenu -->
		</ul>
	</section>
</nav>
<!-- START BLOCK : alert -->
<div data-alert class="alert-box alert text-center">
	<p>{alert}</p>
	<a href="#" class="close">&times;</a>
</div>
<!-- END BLOCK : alert -->
<div class="main-section">
	<!-- START BLOCK : gridIndex -->
	<div class="row">

		<div class="medium-8 columns">
			<div class="show-for-small-only">
				heb jij nog geen account op De Muur? <br> registreer dan nu hier onder!
			</div>
			<div class="show-for-medium-up">
				heb jij nog geen account op De Muur? <br> dat is dan jammer WANT:
				<ul>
					<li>het is de nieuwe social media site</li>
					<li>iedereen is er te vinden</li>
					<li>hylke zit er ook op
						<ul>
							<li>niet dat je daar blij van word</li>
						</ul>
					</li>
				</ul>
				dus ben jij overtuigd?
				<br>
				registreer dan nu aan de rechterkant.
			</div>
		</div>
		<div class="medium-4 columns">
			<div class="row">
				<form action="" method="post" class="small-12 columns">
					<div class="row">
						<div class="small-6 columns"><input type="text" placeholder="naam" name="voornaam" value="{voornaam}"></div>
						<div class="small-6 columns"><input type="text" placeholder="achternaam" name="achternaam" value="{achternaam}"></div>
					</div>
					<div class="row">
						<div class="small-12 columns"><input type="text" placeholder="e-mail" name="email" value="{email}"></div>
					</div>
					<div class="row">
						<div class="small-6 columns"><input type="password" placeholder="wachtwoord" name="password"></div>
						<div class="small-6 columns"><input type="password" placeholder="herhaal wachtwoord" name="wachtwoordHerhaal"></div>
					</div>  
					<div class="row">
						<div class="small-4 columns"><input type="text" placeholder="DD" name="DD" value="{DD}"></div>
						<div class="small-4 columns"><input type="text" placeholder="MM" name="MM" value="{MM}"></div>
						<div class="small-4 columns"><input type="text" placeholder="JJJJ" name="JJJJ" value="{JJJJ}"></div>
					</div>  
					<div class="row">
						<div class="small-6 columns"><input type="text" placeholder="adres" name="adres" value="{adres}"></div>

						<div class="small-3 columns"><input type="text" placeholder="huisnummer" name="huisnummer" value="{huisnummer}"></div>

						<div class="small-3 columns"><input type="text" placeholder="toevoeging" name="toevoeging" value="{toevoeging}"></div>
					</div>
					<div class="row">
						<div class="small-4 columns"><input type="text" placeholder="postcode" name="postcode" value="{postcode}"></div>

						<div class="small-8 columns"><input type="text" placeholder="plaats" name="woonplaats" value="{woonplaats}"></div>
					</div>
					<div class="row">
						<div class="small-12 columns">
							<input type="submit" value="registreren" name="submit" class="button small-12 columns">
						</div>
					</div>     
				</form>
			</div>
		</div>
	</div>
	<!-- END BLOCK : gridIndex -->
	<!-- START BLOCK : gridWall -->
	<div class="row">
		<div class="medium-4 columns hide-for-small">

			<ul class="side-nav">
				<li class="heading">ingelogd als</li>
				<li>
					<div class="row">
						<div class="medium-12 columns">
							<img src="{img}" height="64" width="64" alt="avatar">
						</div>
					</div>
				</li>
				<li><b>{naam}</b></li>
				<li><a href="#">sit</a></li>
				<li><a href="#">amet</a></li>
				<li class="heading">consectur</li>
				<li><a href="#">adipicing</a></li>
				<li><a href="#">elit</a></li>
				<li><a href="#">facilis</a></li>
				<li><a href="#">ducimus</a></li>
				<li class="heading">debitis</li>
				<li><a href="#">incedent</a></li>
				<li><a href="#">eos</a></li>
				<li><a href="#">lure</a></li>
				<li><a href="#">excepturi</a></li>
			</ul>
		</div>
		<div class="medium-8 columns content" >

			<div class="row">
				<div class="small-12 columns">
					<form action="./" method="post">
						<div class="row collapse" data-equalizer>

							<div class="small-12 medium-10 columns"><textarea name="content" cols="30" rows="10" data-equalizer-watch></textarea></div>
							<div class="small-12 medium-2 columns"><input class="button prefix" type="submit" name="submit" value="post" data-equalizer-watch></div>

						</div>
					</form>
				</div>
			</div>

			<div id="myModal" class="reveal-modal" data-reveal>
			</div>

			<!-- START BLOCK : item -->
			<div class="row">
				<div class="small-12 columns">
					<div class="row">
						<div class="small-2 columns">
							<img src="{img}" alt="avatar" width="128" height="128">
						</div>
						<div class="small-10 columns">
							<div class="row">
								<div class="small-10 columns">
									<b>{naam}</b>
								</div>
								<div class="small-2 columns text-right">
									<small>{datum}</small>
									<!-- START BLOCK : postdelete -->
									<a href="./verwijderen/post/{id}"><i class="fi-trash"></i></a>
									<!-- END BLOCK : postdelete -->
								</div>
							</div>
							<div class="row">
								<div class="small-12 columns">{content}</div>
							</div>
						</div>

						<hr>
						<div class="row">
							<div class="small-12 columns">
								<div class="row collapse">
									<a class="small-4 columns button" href="reactie.html" data-reveal-id="myModal" data-reveal-ajax="true"><i style="color:white" class="fi-comment">
									</i> reageren</a>
									

									<a class="small-4 columns button" href="index.php?like=like" >
										<i style="color:white" class="fi-like"></i> like
									</a>

									<a class="small-4 columns button" href="index.php?like=dislike" >
										<i style="color:white" class="fi-dislike"></i> dislike
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- END BLOCK : item -->
			
		</div>
	</div>

	<!-- END BLOCK : gridWall -->
</div>
