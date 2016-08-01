package iruiz.app.businesscase;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Configuration;
import org.springframework.stereotype.Component;

import iruiz.app.dto.SurveyDto;
import iruiz.app.factory.SurveyDtoFactory;
import iruiz.survey.domain.model.Survey;
import iruiz.survey.domain.service.SurveyService;

@Component
public class GetSurveyBusinessCase {
	
	private SurveyService surveyService;
	private SurveyDtoFactory surveyDtoFactory;
	
	public GetSurveyBusinessCase(){
		
	}
	
	@Autowired
	public void injectSurveyService(SurveyService surveyService){
		this.surveyService = surveyService;
	}
	
	@Autowired
	public void injectSurveyDtoFactory(SurveyDtoFactory surveyDtoFactory){
		this.surveyDtoFactory = surveyDtoFactory;
	}
	 
	
	public SurveyDto getSurvey(String slug){
		
		Survey survey = this.surveyService.getSurvey(slug);
		
		return this.surveyDtoFactory.makeFromSurveyModel(survey);
	}
}
