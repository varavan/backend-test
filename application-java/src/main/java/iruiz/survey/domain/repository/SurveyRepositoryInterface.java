package iruiz.survey.domain.repository;

import java.util.ArrayList;
import iruiz.survey.domain.model.Survey;

public interface SurveyRepositoryInterface {
	
	public ArrayList<Survey> findAll();
	
	public Survey findOneBySlug(String slug);
	
}
