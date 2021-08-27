<div class="newsletters-pie-chart-holder" style="width:<?php echo esc_attr($attributes['width']); ?>px; height:<?php echo esc_attr($attributes['height']); ?>px;">
	<canvas id="<?php echo $id; ?>" width="<?php echo $attributes['width']; ?>" height="<?php echo $attributes['width']; ?>"></canvas>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	var data = <?php echo json_encode($data); ?>;
	var options = <?php echo json_encode($options); ?>;
	var ctx = document.getElementById('<?php echo $id; ?>').getContext("2d");
	
	var chart = new Chart(ctx, {
		type: 'doughnut',
		data: data,
		options: {
			tooltips: {
				mode: 'label',
				callbacks: {
                    label: function(tooltipItem, data) {	                    
	                    var label = data.labels[tooltipItem.index] + ': ' + data.datasets[0].data[tooltipItem.index] + '%';
                        return label;
                    }
                }
			}, 
			legend: {
				display: false
			}
		}
	});
});
</script>