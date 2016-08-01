package iruiz.app.businesscase;

import java.util.ArrayList;
import java.util.Iterator;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import iruiz.app.dto.SurveyDto;
import iruiz.app.factory.SurveyDtoFactory;
import iruiz.survey.domain.model.Survey;
import iruiz.survey.domain.service.SurveyService;

@Component
public class GetSurveysBusinessCase {
	
	private SurveyService surveyService;
	private SurveyDtoFactory surveyDtoFactory;
	
	public GetSurveysBusinessCase(){
		
	}
	
	@Autowired
	public void injectSurveyService(SurveyService surveyService){
		this.surveyService = surveyService;
	}
	
	@Autowired
	public void injectSurveyDtoFactory(SurveyDtoFactory surveyDtoFactory){
		this.surveyDtoFactory = surveyDtoFactory;
	}
	
	public ArrayList<SurveyDto> getSurveys(){
		ArrayList<Survey> surveys = this.surveyService.getSurveys();
		ArrayList<SurveyDto> surveysDto = null;
		
		for(Iterator<Survey> i = surveys.iterator(); i.hasNext(); ){
			SurveyDto surveyDto = this.surveyDtoFactory.makeFromSurveyModel(i.next()); 
			surveysDto.add(surveyDto);
		}
		
		return surveysDto;
		
	}
}
