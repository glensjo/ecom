<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Reports
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Reports
                                </div>
                            </div>
                        </div>
                        <form action="/report" method="POST">
                            <div class="form-group">
                                <label for="startdate">Start Date</label>
                                <input type="date" class="form-control" name="startdate">
                            </div>
                            <div class="form-group">
                                <label for="enddate">End Date</label>
                                <input type="date" class="form-control" name="enddate">
                            </div>
							<div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control">
									{% for row in data %}
									<option value="{{row[0]}}">{{row[1]}}</option>
									{% endfor %}
								</select>
                            </div>
                            <button type="submit" class="btn btn-primary">Generate Report</button>  
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
