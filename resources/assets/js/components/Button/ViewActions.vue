 <template>
    <div class="view-custom-actions">
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
      if(action === "view-item")
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
    .view-custom-actions button.ui.button {
      padding: 8px 8px;
    }
    .view-custom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>