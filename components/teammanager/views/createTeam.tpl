<h1>Create a new team</h1>

{form remote='true' url='/silk/teammanager/listTeams'}

<table>
	<tr>
		<td>Enter source directory of photos:</td>
		<td>{textbox name="sourceDir" value="" label=""}</td>
	</tr>
	<tr>
		<td>Enter destination directory for resized photos:</td>
		<td>{textbox name="destDir" value="" label=""}</td>
	</tr>
	<tr>
		<td>Contrain proportions:</td>
		<td>{select name="constrainProportions"}{options items="0,Yes,1,No"}{/select}</td>
	</tr>
	<tr>
		<td>Max height:</td>
		<td>{textbox name="maxHeight" value="" label=""}</td>
	</tr>
	<tr>
		<td>Max width:</td>
		<td>{textbox name="maxWidth" value="" label=""}</td>
	</tr>
	<tr>
		<td>{submit}</td>
	</tr>
</table>


{/form}