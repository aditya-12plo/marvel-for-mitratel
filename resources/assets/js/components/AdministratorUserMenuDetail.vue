<template>
<div class="app-detail">
<table class="table" border="1">
<tr><td align="center">Menu Header</td><td align="center">SUb Menu</td></tr>
<tr v-for="menu in menuHeader">
<td><label><input type="checkbox" :value="menu.id" id="menu.id"> {{menu.menu_name}}</label></td>
<td><div v-for="menuSub in menuDetail" v-if="menuSub.menu_id == menu.id"> <label><input type="checkbox" :value="menuSub.id" id="menuSub.id"> {{menuSub.sub_menu_name}}</label><br></div></td>
</tr>

</table>
</div>
</template>

<script>
export default {
  data () {
    return {
    menuHeader:[{id:'',menu_name:''}],
    menuDetail:[{id:'',menu_id:'',sub_menu_name:''}],

    }
    }

}
</script>

<style>

</style>
