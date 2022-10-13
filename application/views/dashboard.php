<style>

td.the_wheel
{
    background-image: url(./temp/assets/img/wheel_back.png);
    background-position: center;
    background-repeat: none;
}

/* Do some css reset on selected elements */

div.power_controls
{
	display: flex;
    flex-direction: row;
    justify-content: space-between;
}

div.html5_logo
{
    margin-left:70px;
}

/* Styles for the power selection controls */
table.power
{
    background-color: #cccccc;
    cursor: pointer;
    border:1px solid #333333;
}

table.power th
{
    background-color: white;
    cursor: default;
}

td.pw1
{
    background-color: #6fe8f0;
}

td.pw2
{
    background-color: #86ef6f;
}

td.pw3
{
    background-color: #ef6f6f;
}

/* Style applied to the spin button once a power has been selected */
.clickable
{
    cursor: pointer;
}

/* Other misc styles */
.margin_bottom
{
    margin-bottom: 5px;
}

</style>

<div id="content" class="content">
	<div class="row">
		<div class="col-md-7" style="position: relative;">
			<div class="panel panel-inverse">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="box-body">
									<center>
										<div class="wrapper">
											<table cellpadding="0" cellspacing="0" border="0">
												<tr>
													<td>
														<div class="power_controls">
															<br />
															<br />
															<table class="power" cellpadding="10" cellspacing="0">
																<tr>
																	<th align="center" colspan="3" style="text-align: center;">Tenaga Putaran</th>
																</tr>
																<tr>
																	<td width="78" align="center" id="pw3" onClick="powerSelected(3);">High</td>
																	<td width="78" align="center" id="pw2" onClick="powerSelected(2);">Med</td>
																	<td width="78" align="center" id="pw1" onClick="powerSelected(1);">Low</td>
																</tr>
															</table>
															<img id="spin_button" src="<?= base_url('temp/assets/img/spin_off.png') ?>" alt="Spin" onClick="startSpin();" />
															<div>
																<a href="#" onClick="resetWheel(); return false;" style="line-height: 4;">Reset</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
																										<td width="438" height="582" class="the_wheel" align="center" valign="center">
														<canvas id="canvas" width="434" height="434">
															<p style="color: white;" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
														</canvas>
													</td>
												</tr>
											</table>
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-inverse">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="box-body">
									<div class="box-body">
										<table id="data-table" class="table table-sm table-bordered table-hover table-td-valign-middle">
											<thead>
												<tr>
													<th>Nik</th>
													<th>Nama Karyawan</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$no = 1;
													foreach ($karyawan_data as $karyawan) {
													?>
													<tr>
														<td><?php echo $karyawan->nik ?></td>
														<td><?php echo $karyawan->nama_karyawan ?></td>
													</tr>
													<?php
													 } 
												?>
											</tbody>
										</table>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script>
	let theWheel = new Winwheel({
		'outerRadius': 212, // Set outer radius so wheel fits inside the background.
		'innerRadius': 75, // Make wheel hollow so segments don't go all way to center.
		'textFontSize': 8, // Set default font size for the segments.
		// 'textOrientation': 'vertical', // Make text vertial so goes down from the outside of wheel.
		'textAlignment': 'outer', // Align text to outside of wheel.
		'numSegments': <?= $disclass->jumlah_karyawan() ?>, // Specify number of segments.
		'segments': <?= $disclass->list_spinwheeldata() ?>,
		'animation': // Specify the animation to use.
		{
			'type': 'spinToStop',
			'duration': 10, // Duration in seconds.
			'spins': 3, // Default number of complete spins.
			'callbackFinished': alertPrize,
			'callbackSound': playSound, // Function to call when the tick sound is to be triggered.
			'soundTrigger': 'pin' // Specify pins are to trigger the sound, the other option is 'segment'.
		},
		'pins': // Turn pins on.
		{
			'number': 24,
			'fillStyle': 'silver',
			'outerRadius': 4,
		}
	});

	// Loads the tick audio sound in to an audio object.
	let audio = new Audio('<?= base_url('temp/assets/tick.mp3') ?>');

	// This function is called when the sound is to be played.
	function playSound() {
		// Stop and rewind the sound if it already happens to be playing.
		audio.pause();
		audio.currentTime = 0;

		// Play the sound.
		audio.play();
	}

	// Vars used by the code in this page to do power controls.
	let wheelPower = 0;
	let wheelSpinning = false;

	// -------------------------------------------------------
	// Function to handle the onClick on the power buttons.
	// -------------------------------------------------------
	function powerSelected(powerLevel) {
		// Ensure that power can't be changed while wheel is spinning.
		if (wheelSpinning == false) {
			// Reset all to grey incase this is not the first time the user has selected the power.
			document.getElementById('pw1').className = "";
			document.getElementById('pw2').className = "";
			document.getElementById('pw3').className = "";

			// Now light up all cells below-and-including the one selected by changing the class.
			if (powerLevel >= 1) {
				document.getElementById('pw1').className = "pw1";
			}

			if (powerLevel >= 2) {
				document.getElementById('pw2').className = "pw2";
			}

			if (powerLevel >= 3) {
				document.getElementById('pw3').className = "pw3";
			}

			// Set wheelPower var used when spin button is clicked.
			wheelPower = powerLevel;

			// Light up the spin button by changing it's source image and adding a clickable class to it.
			document.getElementById('spin_button').src = "<?= base_url('temp/assets/img/spin_on.png') ?>";
			document.getElementById('spin_button').className = "clickable";
		}
	}

	// -------------------------------------------------------
	// Click handler for spin button.
	// -------------------------------------------------------
	function startSpin() {
		// Ensure that spinning can't be clicked again while already running.
		if (wheelSpinning == false) {
			// Based on the power level selected adjust the number of spins for the wheel, the more times is has
			// to rotate with the duration of the animation the quicker the wheel spins.
			if (wheelPower == 1) {
				theWheel.animation.spins = 3;
			} else if (wheelPower == 2) {
				theWheel.animation.spins = 6;
			} else if (wheelPower == 3) {
				theWheel.animation.spins = 10;
			}

			// Disable the spin button so can't click again while wheel is spinning.
			document.getElementById('spin_button').src = "<?= base_url('temp/assets/img/spin_off.png')?>";
			document.getElementById('spin_button').className = "";

			// Begin the spin animation by calling startAnimation on the wheel object.
			theWheel.startAnimation();

			// Set to true so that power can't be changed and spin button re-enabled during
			// the current animation. The user will have to reset before spinning again.
			wheelSpinning = true;
		}
	}

	// -------------------------------------------------------
	// Function for reset button.
	// -------------------------------------------------------
	function resetWheel() {
		theWheel.stopAnimation(false); // Stop the animation, false as param so does not call callback function.
		theWheel.rotationAngle = 0; // Re-set the wheel angle to 0 degrees.
		theWheel.draw(); // Call draw to render changes to the wheel.

		document.getElementById('pw1').className = ""; // Remove all colours from the power level indicators.
		document.getElementById('pw2').className = "";
		document.getElementById('pw3').className = "";

		wheelSpinning = false; // Reset to false to power buttons and spin can be clicked again.
	}

	// -------------------------------------------------------
	// Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
	// -------------------------------------------------------
	function alertPrize(indicatedSegment) {
		// Just alert to the user what happened.
		// In a real project probably want to do something more interesting than this with the result.
		if (indicatedSegment.text == 'LOOSE TURN') {
			alert('Sorry but you loose a turn.');
		} else if (indicatedSegment.text == 'BANKRUPT') {
			alert('Oh no, you have gone BANKRUPT!');
		} else {
			alert(indicatedSegment.text + " Menang! ID:" + indicatedSegment.id_karyawan);
		}
	}
	// // update mychart.data.datasets[0].data using ajax
	// fetch("<?= base_url('dashboard/list_karyawan') ?>")
	// 	.then(response => response.json())
	// 	.then(data => {
	// 		console.log(data);

	// 		let data_nik = []

	// 		data.forEach(element => {
	// 			data_nik.push(element.nik)
	// 		});
	// 		console.log(data_nik)
	// 		myChart.data.datasets[0].data = data_nik
	// 		myChart.data.labels = data_nik
	// 		myChart.update();
	// 	})
</script>