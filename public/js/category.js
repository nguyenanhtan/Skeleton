
  function print_cat(tree){
    
  }
  function print_tree(root_id,arr,map){
    console.log("..");
    //console.log("root_id: "+JSON.stringify(map[root_id]));
    x = '<li id="'+arr[root_id].id+'">';
    //x+= '<span>'+arr[root_id].title+'</span><ul>';
    x += '<div class=""><label for="checkbox-'+arr[root_id].id+'"><input class="category-checkbox" type="checkbox" value="'+arr[root_id].id+'">'+arr[root_id].title+'</label></div>';
    x += "<ul>";
    for(i in map[root_id]){     
      if(is_leaf(map[root_id][i], map)){
        x+=print_nod(arr[map[root_id][i]]);
      }else{
        x+=print_tree(map[root_id][i],arr,map);
      }
    }
    x+='</ul></li>';
    return x;
  }
  function is_leaf(id_nod, tree){
    console.log("tree["+id_nod+"]="+tree[id_nod]);
    if(!tree.hasOwnProperty(id_nod)){
      console.log("nod "+id_nod+" is leaf");
      return true;
    }else{
      console.log("nod "+id_nod+" is not leaf");
      return false;
    }
  }
  function print_nod(nod){
    
    x = '<div class=""><label for="checkbox-'+nod.id+'"><input class="category-checkbox" type="checkbox" value="'+nod.id+'">'+nod.title+'</label></div>';
    y = '<li id="'+nod.id+'">'+x+'</li>';
    return y;
  }
  function print_select(root_id,arr,map,num){   
    sp = "";
    for(i = 0;i<num*2;i++){
      sp += "- ";
    } 
    x = '<option value="'+arr[root_id].id+'">'+sp+arr[root_id].title+'</option>';
    console.log("map: "+map[root_id]);
    //num++;
    for(i in map[root_id]){     
      if(is_leaf(map[root_id][i], map)){
        x+=print_nod_select(arr[map[root_id][i]],num+1);
      }else{
        x+=print_select(map[root_id][i],arr,map,num+1);
      }
    }    
    return x;
  }
  function print_nod_select(nod,num){
    x = "";
    for(i = 0;i<num*2;i++){
      x += "- ";
    }
    x += nod.title;
    y = '<option value="'+nod.id+'">'+x+'</option>';
    return y;
  }