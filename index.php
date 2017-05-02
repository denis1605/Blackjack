<html>
<head>
	<title>
		Blackjack
	</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/vue"></script>
</head>
<body>
	<div id="app">


		<?php

		include("deck.php");
//shuffling array
		shuffle($deck);

		//dealing cards
		$p1 = [$deck[0],$deck[1]];
		$p2 = [$deck[2],$deck[3]];

		//getting start score and cards
		$p1Cards = [ array_keys($p1[0])[0] , array_keys($p1[1])[0] ];
		$p1Score = array_values($p1[0])[0] + array_values($p1[1])[0];
		$p2Cards = [ array_keys($p2[0])[0] , array_keys($p2[1])[0] ];
		$p2Score = array_values($p2[0])[0] + array_values($p2[1])[0];

//removing dealed cards from array

		$deck = array_slice($deck, 4);


		echo "<pre>";
		// print_r($deck);
		echo "</pre>";

		?>

		<div class="container">
			<div class="row">
				<h2 class="text-center" style="color:red;">Black Jack</h2>
				<div class="col-sm-6 text-center">
					<h2>Player 1</h2>
					<div id="p1_cards" class="cards">
						<ul class="list-unstyled">
							<li v-for="card in p1Cards" v-text="card"></li>
						</ul>
					</div>
					<div class="score">Score:</div>
					<div id="p1_score" class="score_number" style="font-size: 48px" v-text="p1Score"></div>
					<span v-if="!p1done">
						<a href="#" @click.prevent="oneMoreCard()" class="btn btn-success btn-lg">ONE MORE CARD</a>
						<a href="#" @click.prevent="enough()" class="btn btn-danger btn-lg">ENOUGH</a>
					</span>
				</div>
				<div class="col-sm-6 text-center">
					<h2>Player 2</h2>
					<span v-if="p1done">
						<div id="p2_cards" class="cards">
							<ul class="list-unstyled">
								<li v-for="card2 in p2Cards" v-text="card2"></li>
							</ul>
						</div>
						<div class="score">Score:</div>
						<div id="p2_score" class="score_number" style="font-size: 48px" v-text="p2Score"></div>
					</span>
				</div>
			</div>
		</div>
	</div>
	<script>

		new	Vue({
			el:"#app",
			data:{
				deck: <?=json_encode($deck)?>,
				p1Score: <?=$p1Score?>,
				p2Score: <?=$p2Score?>,
				p1Cards: <?=json_encode($p1Cards)?>,
				//coding in json string, beacuas js cannot read php array
				p2Cards: <?=json_encode($p2Cards)?>,
				p1done: false

			},
			methods:{

				oneMoreCard: function(){
					for (var first in this.deck[0])
						break;
					this.p1Cards.push(first);
					this.p1Score += parseInt(this.deck[0][first]);
					this.deck.splice(0,1);
					this.didGameEnded();

				},
				didGameEnded: function(){
					if(this.p1Score > 21 || this.p2Score > 21){
						this.p1done = true;
						alert("GAME OVER");

					}
				},
				enough: function(){
					this.p1done = true

				}
			}

		});


	</script>
</body>
</html>
