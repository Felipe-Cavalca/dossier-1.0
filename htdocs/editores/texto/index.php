<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

		<link rel="stylesheet" href="editores/texto/minified/themes/default.min.css" id="theme-style" />
		  
		<script src="editores/texto/minified/sceditor.min.js"></script>
		<script src="editores/texto/minified/icons/monocons.js"></script>
		<script src="editores/texto/minified/formats/bbcode.js"></script>

		<style>
			html {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 13px;
			}
			form div {
				padding: .5em;
			}
			code:before {
				position: absolute;
				content: 'Code:';
				top: -1.35em;
				left: 0;
			}
			code {
				margin-top: 1.5em;
				position: relative;
				background: #eee;
				border: 1px solid #aaa;
				white-space: pre;
				padding: .25em;
				min-height: 1.25em;
			}
			code:before, code {
				display: block;
				text-align: left;
			}
		</style>
	</head>
	<body>
        <?php
    		if ($div == 'example'){
    		    echo'
        		<form action="editores/texto/salvar.php" method="post">
        		    <div class="input-field">
                        <label for="nome"> Nome </label>
                        <input class="glyphicon-th" type="text" name="nome">
                    </div>
        			<div>
        				<textarea name="texto" id="'.$div.'" style="height:500px;" placeholder="insira o texto aqui"></textarea>
        			</div>
        			<button class="btn waves-effect grey darken-4" type="submit" name="Enviar">salvar<i class="material-icons right">send</i>
                    </button>
                </form>';
    		}
        	else{
        	    //style="height:100%;width:100%;"
        	    echo'
        		<form action="editores/texto/editar.php?id='.$id.'" method="post" style="height:500px;">
        			<div>
        				<textarea name="texto" id="'.$div.'" style="height:500px;">'.$texto.'</textarea>
        			</div>
        			';
        		if ($editavel == 's'){
        			echo '<button class="btn waves-effect grey darken-4" type="submit" name="Enviar">salvar alterações<i class="material-icons right">send</i>
                    </button>';}
                echo '
                </form>';
        	}	
        

            if ($extensao=="dssr"){
                echo"
        		<script>
        			var textarea = document.getElementById('$div');
        			sceditor.create(textarea, {
        				format: 'bbcode',
        				icons: 'monocons',
        				style: 'editores/texto/minified/themes/content/default.min.css'
        			});
        
        
        			var themeInput = document.getElementById('theme');
        			themeInput.onchange = function() {
        				var theme = 'editores/texto/minified/themes/' + themeInput.value + '.min.css';
        
        				document.getElementById('theme-style').href = theme;
        			};
        		</script>
        		";
    		}
		?>
	</body>
</html>
