<h1>List Teams</h1>

Using smarty to loop through results.

<table>
<tr>
	<th>Name</th>
	<th>Start - End</th>
</tr>
{section name=mysec loop=$seasons}
{strip}
   <tr bgcolor="{cycle values="#BBBBBB,#DDDDDD"}">
      <td>{$seasons[mysec].name}</td>
      <td>{$seasons[mysec].start_year} - {$seasons[mysec].end_year}</td>
      <td>{$seasons[mysec]->stages}</td>
   </tr>
{/strip}
{/section}
</table>
