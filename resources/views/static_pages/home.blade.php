@extends('layouts.app')

@section('content')
<div id="doc-content">
<textarea style="display:none;">
djflsfjls
# 这是一个h1标签
## 这是一个h2标签
```html
<style type="text/css">
h1{
	color: red;
	font-size: 30px;
}
.div1{
	color: #666;
}
</pre>
```

```javascript
// 你好呀
<script>
function test(){
  console.log("Hello world!");
}
(function(){
    var box = function(){
        return box.fn.init();
    };
    box.prototype = box.fn = {
        init : function(){
            console.log('box.init()');
            return this;
        },
        add : function(str){
            alert("add", str);
            return this;
        },
        remove : function(str){
            alert("remove", str);
            return this;
        }
    };
    box.fn.init.prototype = box.fn;
    window.box =box;
})();
var testBox = box();
testBox.add("jQuery").remove("jQuery");
</script>
```

```php
&lt;?php

namespace App\Http\Controllers;
.
.
.
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [            
            'except' => ['show', 'create', 'store']
        ]);
    }
    .
    .
    .
}
```
</textarea>
</div>
@stop

