package iruiz.survey.domain.service;

import java.util.ArrayList;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import iruiz.survey.domain.model.Survey;
import iruiz.survey.domain.repository.SurveyRepositoryInterface;

@Service
public class SurveyService {
	
	private SurveyRepositoryInterface surveyRepositoryInterface;
	
	@Autowired
	public void injectSurveyRepository(SurveyRepositoryInterface surveyRepositoryInterface){
		this.surveyRepositoryInterface = surveyRepositoryInterface;
	}
	
	public ArrayList<Survey> getSurveys(){
		return this.surveyRepositoryInterface.findAll();
	}
	
	public Survey getSurvey(String slug){
		return this.surveyRepositoryInterface.findOneBySlug(slug);
	}
	
}
