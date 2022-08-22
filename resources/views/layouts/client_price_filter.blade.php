
    <thead>
        <tr>
            <td colspan="2">Giá</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="radio" onchange='this.form.submit();' {{app('request')->input('r-price')=='under500'?'checked':''}} id='under500' value="under500" class="r-price"  name="r-price"> </td>
            <td><label for="under500">Dưới 500.000đ</label></td>
        </tr>
        <tr>
            <td><input type="radio" onchange='this.form.submit();' {{app('request')->input('r-price')=='between500tAndnd1m'?'checked':''}}  id='between500tAndnd1m' value="between500tAndnd1m" class="r-price" name="r-price"></td>
            <td><label for="between500tAndnd1m">500.000đ - 1.000.000đ</label></td>
        </tr>
        <tr>
            <td><input type="radio" onchange='this.form.submit();' {{app('request')->input('r-price')=='between1mAnd5m'?'checked':''}}  id='between1mAnd5m' value="between1mAnd5m" class="r-price" name="r-price"></td>
            <td><label for="between1mAnd5m">1.000.000đ - 5.000.000đ</label></td>
        </tr>
        <tr>
            <td><input type="radio" onchange='this.form.submit();' {{app('request')->input('r-price')=='between5mAnd10m'?'checked':''}}  id='between5mAnd10m' value="between5mAnd10m" class="r-price" name="r-price"></td>
            <td><label for="between5mAnd10m">5.000.000đ - 10.000.000đ</label></td>
        </tr>
        <tr>
            <td><input type="radio" onchange='this.form.submit();' {{app('request')->input('r-price')=='older10m'?'checked':''}}  id='older10m' value="older10m" class="r-price" name="r-price"></td>
            <td><label for="older10m">Trên 10.000.000đ</label></td>
        </tr>
    </tbody>