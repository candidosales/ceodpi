		<aside class="right">
					<div class="widget">
						<script src="http://widgets.twimg.com/j/2/widget.js"></script>
						<script>
							new TWTR.Widget({
							  version: 2,
							  type: 'profile',
							  rpp: 3,
							  interval: 6000,
							  width: 'auto',
							  height: 300,
							  theme: {
								shell: {
								  background: '#ffffff',
								  color: '#24528D'
								},
								tweets: {
								  background: '#ffffff',
								  color: '#444444',
								  links: '#24528D'
								}
							  },
							  features: {
								scrollbar: false,
								loop: false,
								live: false,
								hashtags: true,
								timestamp: true,
								avatars: true,
								behavior: 'all'
							  }
							}).render().setUser('mktpolitico_pi').start();

						</script>
					</div>
			</aside>