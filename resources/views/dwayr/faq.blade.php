@include('includes.header')
    <body ng-controller="faq">
        <section class="faq">
            

           
           
           <v-accordion class="vAccordion--default">

  <v-pane ng-repeat="pane in panes" expanded="pane.isExpanded">
    <v-pane-header>
      {% pane.header %}
    </v-pane-header>

    <v-pane-content>
      {% pane.content %}

      <!-- accordions can be nested :) -->
      <v-accordion ng-if="pane.subpanes">
        <v-pane ng-repeat="subpane in pane.subpanes" ng-disabled="subpane.isDisabled">
          <v-pane-header>
            {% subpane.header %}
          </v-pane-header>
          <v-pane-content>
            {% subpane.content %}
          </v-pane-content>
        </v-pane>
      </v-accordion>
    </v-pane-content>
  </v-pane>

</v-accordion>
            
        </section>
    </body>
@include('includes.footer')