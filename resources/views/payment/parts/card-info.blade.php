<div id="loadDynamicData" class="container">
    <div>
        <div class="row">
            <div class="col-md-12 main-content">
                {!! Form::open(['id' => 'billing-form']) !!}
                <div id="error-message"></div>

                <div class="row">
                    <div class="col-md-2">
                        Card Number :
                    </div>
                    <div class="col-md-2">

                        <input type="text" data-stripe="number">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        CVC Number :
                    </div>
                    <div class="col-md-2">

                        <input type="text" data-stripe="cvc">

                    </div>
                </div>
                <div class="row">

                    <div class="col-md-2">

                        <input type="hidden" data-stripe="email">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        Expire Date :
                    </div>
                    <div class="col-md-4">

                        {!! Form::selectMonth(null,date('m'),['data-stripe' => 'exp-month']) !!}
                        {!! Form::selectYear(null,date('Y'),date('Y') + 10,null,['data-stripe' => 'exp-year'] ) !!}

                    </div>

                </div>

                <div class="clearfix">&nbsp;</div>

                <div class="row">
                    <div class="col-md-offset-2" text-center>
                        {!! Form::submit('Proceed') !!}
                    </div>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
        <br><br>
    </div>
</div>