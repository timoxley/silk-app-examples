<h1>List Teams</h1>

Using smarty to loop through results.

<table>
{section name=mysec loop=$teams}
{strip}
   <tr bgcolor="{cycle values="#FFFFCC,#DDDDDD"}">
   	  <td>Name</td>
      <td>{$teams[mysec].name}</td>
   </tr>
{/strip}
{/section}
</table>
