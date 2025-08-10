				<td>
					<a href="{{ route('images.show', $image) }}">Voir</a> 
					
					
					@auth
						@if (Auth::user()->role === 'admin')
							<a href="{{ route('images.edit', $image) }}">Modifier</a>
						@endif   
					@endauth
					
					
				</td>
