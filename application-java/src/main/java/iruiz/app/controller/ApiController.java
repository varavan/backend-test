package iruiz.app.controller;


import java.util.ArrayList;
import java.util.Iterator;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import iruiz.app.businesscase.GetSurveyBusinessCase;
import iruiz.app.businesscase.GetSurveysBusinessCase;
import iruiz.app.component.SurveyDtoToJsonTransformer;
import iruiz.app.dto.SurveyDto;

@RestController
public class ApiController {
	
	private GetSurveyBusinessCase getSurveyBusinessCase;
	private GetSurveysBusinessCase getSurveysBusinessCase;
	
	@Autowired
	public void injectBusinessCases(
			GetSurveyBusinessCase getSurveyBusinessCase,
			GetSurveysBusinessCase getSurveysBusinessCase)
	{
		this.getSurveyBusinessCase = getSurveyBusinessCase;
		this.getSurveysBusinessCase = getSurveysBusinessCase;
	}
	
	@RequestMapping("/surveys")
    public String surveys() {
		
		ArrayList<SurveyDto> surveys = this.getSurveysBusinessCase.getSurveys();
		
		String response = "[";
		for(Iterator<SurveyDto> i = surveys.iterator(); i.hasNext(); ){
				SurveyDto surveyDto = i.next();
				response = response + SurveyDtoToJsonTransformer.transform(surveyDto);
				
				if(i.hasNext()){
					response = response + ",";
				}
		}
		response = response + "]";
		
        return response;
    }
	
	
	@RequestMapping("/survey")
    public String survey(@RequestParam(value="slug", required=false, defaultValue="any") String slug) {
		SurveyDto survey = this.getSurveyBusinessCase.getSurvey(slug);
		
        return (survey == null )
        		? "Not found" // should return 404
        	    : SurveyDtoToJsonTransformer.transform(survey);
    }
	
	
	
}
