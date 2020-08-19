<!-- Modal -->
<div class="modal fade" id="sitemapDialog" tabindex="-1" role="dialog" aria-labelledby="sitemapDialogTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="card">
				<div class="modal-header card-header-primary rounded-pill">
					<h5 class="card-title" id="sitemapDialogTitle">Generate Sitemap</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="key" class="bmd-label-floating">Enter Security Key</label>
						<input type="password" class="form-control" id="key" name="key">
					</div>
				</div>
				<div class="card-footer">
					<button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary rounded-pill" id="okSitemapeButton">Ok</button>
				</div>
			</div>
		</div>
	</div>
</div>

@push('scripts_bottom')
<script type="text/javascript">
	$(document).ready(function(){
		$('#okSitemapeButton').click(function(e){
			let url = '{{ route('api-admin-setup-sitemap') }}'
			let data = {
				key: $('#sitemapDialog input#key').val(),
				api_token: '{{ api_token() }}'
			}
			$.post(url,data).then(function(response){
                let pre = document.createElement('pre')
                pre.innerText = response.sitemap
                let results = document.getElementById('setup_results')
                // results.innerHTML = null
				results.appendChild(pre)
			})
			$('#sitemapDialog').modal('hide')
		})
	})
</script>

@endpush
