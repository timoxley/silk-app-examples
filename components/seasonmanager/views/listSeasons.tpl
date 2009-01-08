<h1>List Teams</h1>

Using smarty to loop through results.

<table>
<tr>
	<th>Name</th>
	<th>Start - End</th>
</tr>
{foreach from=$seasons item=season key=key}
{strip}
   <tr bgcolor="{cycle values="#BBBBBB,#DDDDDD"}">
      <td>{$season.name}</td>
      <td>{$season.start_year} - {$season.end_year}</td>
      <td>
	      {foreach from=$season->stages item=entry key=name}
	      {strip}
	      {$entry.name}<br />
	      {/strip}
	      {/foreach}
	  </td>
   </tr>
{/strip}
{/foreach}
</table>
