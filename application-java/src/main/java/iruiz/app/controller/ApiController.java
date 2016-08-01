package iruiz.app.controller;


import java.util.ArrayList;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import iruiz.app.businesscase.GetSurveyBusinessCase;
import iruiz.app.businesscase.GetSurveysBusinessCase;
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
		
        return surveys.get(0).name;
    }
	
	
	@RequestMapping("/surveys/slug")
    public String survey() {
		
		SurveyDto survey = this.getSurveyBusinessCase.getSurvey("aa");
		
        return survey.name;
    }
	
	
	
}
