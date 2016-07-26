package bussiness_case;

import dto.SurveyDto;
import factory.SurveyDtoFactory;
import survey.domain.model.Survey;
import survey.domain.service.SurveyService;

public class GetSurveyBusinessCase {
	
	private SurveyService surveyService;
	private SurveyDtoFactory surveyDtoFactory;
	
	public GetSurveyBusinessCase(
			SurveyService surveyService,
			SurveyDtoFactory surveyDtoFactory){
		this.surveyService = surveyService; 
		this.surveyDtoFactory = surveyDtoFactory;
	}
	
	public SurveyDto getSurvey(String slug){
		
		Survey survey = this.surveyService.getSurvey(slug);
		
		return this.surveyDtoFactory.makeFromSurveyModel(survey);
	}
}
