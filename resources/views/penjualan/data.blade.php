@foreach($data as $key => $d)
<tr>
	<td>{{ $d->nobukti }}</td>
	<td>{{ \Carbon\Carbon::parse($d->tanggal)->format('d/m/y')}}</td>
    <td>{{ $d->customer }}</td>
    <td align="right">@currency($d->nilai)</td>
    <td align="right">@currency($d->bayar)</td>
    <td align="right">@currency($d->kredit)</td>
    <td align="right">@currency($d->potongnota)</td>
    <td align="right">@currency($d->pembayaran)</td>
    <td align="right">@currency($d->saldo)</td>
    <td>
		<a href="{{url('read',array($d->id))}}">Read</a>
		
	</td>
</tr>
@endforeach
<tr>
  <td colspan="11" align="center">
   
  </td>
</tr>