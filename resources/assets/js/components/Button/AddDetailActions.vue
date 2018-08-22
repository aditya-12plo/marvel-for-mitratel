 <template>
    <div class="add-detail-custom-actions">
      <button class="btn btn-sm" @click="itemAction('add-item', rowData, rowIndex)"><i class="ft-plus">ADD</i></button>
      <button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="ft-zoom-in">Detail</i></button>
    </div>

  </template>

  <script>

  export default {
    props: {
      rowData: {
        type: Object,
        required: true
      },
      rowIndex: {
        type: Number
      }
    },
    methods: {
      itemAction (action, data, index) {
      if(action === "add-item")
      {
               this.$root.$emit('additem', data , index);
			   
      }
      else if(action === "view-item")
      {
               this.$root.$emit('viewitem', data , index);
         
      }
      else
      {
alert('error');
      }
        
      }
      }
      
    
  }
  </script>

  <style>
    .add-detail-custom-actions button.ui.button {
      padding: 8px 8px;
    }
    .add-detail-custom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>