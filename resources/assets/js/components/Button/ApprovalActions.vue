 <template>
    <div class="approval-custom-actions">
      <button class="btn btn-sm" @click="itemAction('approval-item', rowData, rowIndex)"><i class="ft-plus">Approval</i></button>
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
      if(action === "approval-item")
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
    .approval-custom-actions button.ui.button {
      padding: 8px 8px;
    }
    .approval-custom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>