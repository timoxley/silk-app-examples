<h1>Create a new season</h1>

{form remote='true' url='/silk/season_manager/createSeasonStore'}

<table>
	<tr>
		<td>Name of season:</td>
		<td>{textbox name="seasonName" value="" label=""}</td>
	</tr>
	<tr>
		<td>Starting year:</td>
		<td>{textbox name="startYear" value="" label=""}</td>
	</tr>
	<tr>
		<td>Ending year:</td>
		<td>{textbox name="endYear" value="" label=""}</td>
	</tr>
	<tr>
		<td>Status:</td>
		<td>{select name="status"}{options items="0,Inactive,1,Active"}{/select}</td>
	</tr>
	<tr>
		<td>{submit}</td>
	</tr>
</table>


{/form}
