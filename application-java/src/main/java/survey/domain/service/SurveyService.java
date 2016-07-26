package survey.domain.service;

import survey.domain.model.Survey;
import survey.domain.repository.SurveyRepositoryInterface;

public class SurveyService {
	
	private SurveyRepositoryInterface surveyRepositoryInterface;
	
	public SurveyService(SurveyRepositoryInterface surveyRepositoryInterface){
		this.surveyRepositoryInterface = surveyRepositoryInterface;
	}
	
	public Survey[] getSurveys(){
		return this.surveyRepositoryInterface.findAll();
	}
	
	public Survey getSurvey(String slug){
		return this.surveyRepositoryInterface.findOneBySlug(slug);
	}
	
}
