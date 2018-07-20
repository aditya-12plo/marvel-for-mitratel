 <template>
    <div class="add-custom-actions">
      <button class="btn btn-sm" @click="itemAction('add-item', rowData, rowIndex)"><i class="ft-plus">ADD</i></button>
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
    .add-custom-actions button.ui.button {
      padding: 8px 8px;
    }
    .add-custom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>